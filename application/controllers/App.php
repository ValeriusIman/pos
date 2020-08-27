<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model(array("Barang_m", "Pelanggan_m", "Cart_m", "Transaksi_m", "ItemTransaksi_m", "User_m", "Tunda_m", "ItemTunda_m"));
    }

    public function index()
    {
        $user = $this->User_m->getAll()->result();
        $barang = $this->Barang_m->getAll();
        $pelanggan = $this->Pelanggan_m->getAll();
        $cart = $this->Cart_m->getAllCart()->result();

        //1.cari dulu nilai terbesar dari id yang terakhir
        $queryMaxId = "select ifnull(max(nomor),0) as max from transaksi "
            . "WHERE DAY(tanggal_transaksi) = DAY(NOW()) AND MONTH(tanggal_transaksi) = MONTH(NOW()) AND YEAR(tanggal_transaksi)=YEAR(NOW())";
        $max = $this->db->query($queryMaxId)->row()->max;
        $max = (int) $max;
        // "TRX/2020/04/0120"
        $strPad = str_pad($max + 1, 4, "0", STR_PAD_LEFT);
        $noTransaksi = "TRX/" . date("ymd") . "/" . $strPad;

        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Aplikasi Kasir",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/app/v_app",
            "users" => $user,
            "barangs" => $barang,
            "pelanggans" => $pelanggan,
            "cart" => $cart,
            "noTransaksi" => $noTransaksi
        );
        $this->load->view('tamplates/main', $data);
    }

    public function prosesTransaksi()
    {
        //1.cari dulu nilai terbesar dari id yang terakhir
        $queryMaxId = "select ifnull(max(nomor),0) as max from transaksi "
            . "WHERE DAY(tanggal_transaksi) = DAY(NOW()) AND MONTH(tanggal_transaksi) = MONTH(NOW()) AND YEAR(tanggal_transaksi)=YEAR(NOW())";
        $max = $this->db->query($queryMaxId)->row()->max;
        $max = (int) $max;
        // "TRX/2020/04/0120"
        $strPad = str_pad($max + 1, 4, "0", STR_PAD_LEFT);
        $noTransaksi = "TRX/" . date("ymd") . "/" . $strPad;

        $dataTransaksi = array(
            "no_transaksi" => $noTransaksi,
            "user_id" => $this->input->post("id_user"),
            "pelanggan_id" => $this->input->post("id_pelanggan"),
            "tanggal_transaksi" => $this->input->post("tanggal"),
            "total_harga" => $this->input->post("total"),
            "diskon" => $this->input->post("diskon"),
            "bayar" => $this->input->post("bayar"),
            "kembalian" => $this->input->post("kembalian"),
            "nomor" => ($max + 1),
            "grand_total" => $this->input->post("grand_total")
        );

        if (isset($_POST['proses'])) {
            $idTransaksi = $this->Transaksi_m->insertGetId($dataTransaksi);
            $cart = $this->Cart_m->getAllCart()->result();
            $row = [];
            foreach ($cart as $k => $value) {
                array_push(
                    $row,
                    array(
                        'transaksi_id' => $idTransaksi,
                        'barang_id' => $value->barang_id,
                        'harga_item_transaksi' => $value->harga,
                        'qty_item_transaksi' => $value->qty,
                        'total_item_transaksi' => $value->total,
                        'total_hpp' => $value->total_hpp,
                    )
                );
            }
            $this->ItemTransaksi_m->insertBatch($row);
            $this->Cart_m->delCart(['user_id' => $this->session->userdata('user_id')]);
            if ($this->db->affected_rows() > 0) {
                $keranjang = array("success" => true, "id_transaksi" => $idTransaksi);
            } else {
                $keranjang = array("success" => false);
            }
            echo json_encode($keranjang);
        } else if (isset($_POST['tunda_transaksi'])) {
            //1.cari dulu nilai terbesar dari id yang terakhir
            $queryMaxId = "select ifnull(max(nomor),0) as max from transaksi_tunda "
                . "WHERE DAY(tanggal) = DAY(NOW()) AND MONTH(tanggal) = MONTH(NOW()) AND YEAR(tanggal)=YEAR(NOW())";
            $max = $this->db->query($queryMaxId)->row()->max;
            $max = (int) $max;
            // "TRX/2020/04/0120"
            $strPad = str_pad($max + 1, 4, "0", STR_PAD_LEFT);
            $noTunda = "TND/" . date("ymd") . "/" . $strPad;

            $data = array(
                "no_tunda" => $noTunda,
                "user_id" => $this->input->post("id_user"),
                "nomor" => ($max + 1),
                "tanggal" => date("Y-m-d H:i:s")
            );

            $transaksi_id = $this->Tunda_m->insertGetId($data);
            $cart = $this->Cart_m->getAllCart()->result();
            // $index = 0;
            $row = [];
            foreach ($cart as $k => $value) {
                array_push(
                    $row,
                    array(
                        'tunda_id' => $transaksi_id,
                        'barang_id' => $value->barang_id,
                        'harga' => $value->harga,
                        'qty' => $value->qty,
                        'total' => $value->total,
                        'hpp' => $value->hpp,
                        'total_hpp' => $value->total_hpp,
                    )
                );
            }
            $this->ItemTunda_m->insertBatchTunda($row);
            $this->Cart_m->delCart(['user_id' => $this->session->userdata('user_id')]);

            if ($this->db->affected_rows() > 0) {
                $data = array("success" => true);
            } else {
                $data = array("success" => false);
            }
            echo json_encode($data);
        }
    }

    public function print($id)
    {
        $transaksi = $this->Transaksi_m->getJoin($id);
        $item = $this->ItemTransaksi_m->joinLengkap($id);
        $data = array(
            "transaksi" => $transaksi,
            "item" => $item
        );
        $this->load->view('transaksi/app/print', $data);
    }

    public function proses()
    {
        $data = $this->input->post(null, true);
        if (isset($_POST['proses'])) {
            $item_id = $this->input->post('barang_id');
            $check_cart = $this->Cart_m->getAllCart(['cart.barang_id' => $item_id])->num_rows();

            if ($check_cart > 0) {
                $this->Cart_m->updateQty($data);
            } else {
                $this->Cart_m->add_cart($data);
            }

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function cartData()
    {
        $cart = $this->Cart_m->getAllCart()->result();
        $data['cart'] = $cart;
        $this->load->view('transaksi/app/item', $data);
    }

    public function cartDel()
    {
        if (isset($_POST['batal'])) {
            $this->Cart_m->delCart(['user_id' => $this->session->userdata('user_id')]);
        } else {
            $cart_id = $this->input->post('cart_id');
            $this->Cart_m->delCart(['cart_id' => $cart_id]);
        }

        if ($this->db->affected_rows() > 0) {
            $params = array("success" => true);
        } else {
            $params = array("success" => false);
        }
        echo json_encode($params);
    }

    public function tunda()
    {
        $listTransaksi = $this->Tunda_m->getAll()->result();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Transaksi Tertunda",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "tunda" => $listTransaksi,
            "page" => "transaksi/app/tunda/tunda_list"
        );
        $this->load->view("tamplates/main", $data);
    }

    public function prosesTunda()
    {
        $id = $this->input->post("id_transaksi_tunda");
        $keranjang = $this->Tunda_m->get_item_tunda_bykode($id);
        // $index = 0;
        $row = [];
        foreach ($keranjang as $k => $value) {
            array_push(
                $row,
                array(
                    'cart_id' => $value->id_item_tunda,
                    'barang_id' => $value->barang_id,
                    'harga' => $value->harga,
                    'qty' => $value->qty,
                    'total' => $value->total,
                    'hpp' => $value->hpp,
                    'total_hpp' => $value->total_hpp,
                    'user_id' => $this->session->userdata('user_id')
                )
            );
        }
        $this->Cart_m->insertBatchTundaTransaksi($row);

        $this->ItemTunda_m->delete_tundaitemtransaksi(['tunda_id' => $id]);
        $this->Tunda_m->delete_tundatransaksi(['id_tunda' => $id]);

        if ($this->db->affected_rows() > 0) {
            $keranjang = array("success" => true);
        } else {
            $keranjang = array("success" => false);
        }
        echo json_encode($keranjang);
    }
}

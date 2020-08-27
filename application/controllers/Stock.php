<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        not_login();
        $this->load->model(array("Stock_m", "Barang_m", "Supplier_m"));
    }

    public function appStock()
    {
        $barang = $this->Barang_m->getAll();
        $supplier = $this->Supplier_m->getAll();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "App Stock In/Out",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/stock/app_stock_in",
            "barangs" => $barang,
            "suppliers" => $supplier
        );
        $this->load->view('tamplates/main', $data);
    }

    public function stockIn()
    {
        $stock = $this->Stock_m->getAllStockIn();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Stock-In",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/stock/v_stock_in",
            "stocks" => $stock,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function stockOut()
    {
        $stock = $this->Stock_m->getAllStockOut();
        $result = userData(); //fungsi_helper
        $data = array(
            "title" => "Stock-Out",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/stock/v_stock_out",
            "stocks" => $stock,
        );
        $this->load->view('tamplates/main', $data);
    }


    public function detail($id)
    {
        $result = userData(); //fungsi_helper
        $stock = $this->Stock_m->getJoinStockIn($id);
        $stockIn = $this->Stock_m->getJoinStockInItem($id);
        $stockOut = $this->Stock_m->getJoinStockOut($id);
        $data = array(
            "title" => "Detail Stock",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/stock/v_stock_detail",
            "stock" => $stock,
            "stockIn" => $stockIn,
            "stockOut" => $stockOut,

        );
        $this->load->view('tamplates/main', $data);
    }

    public function prosesTambah()
    {
        $str_item = $this->input->post("item_stock");
        $itemStock = json_decode($str_item);

        $stock = array(
            "no_struck" => $this->input->post("noStruck", true),
            "date" => $this->input->post("tanggal", true),
            "user_id" => $this->session->userdata('user_id'),
            "type" => $this->input->post("type", true),
            "detail" => $this->input->post("detail", true)
        );

        if (isset($_POST['proses_in'])) {
            $idStock = $this->Stock_m->insertGetId($stock);
            $index = 0;
            foreach ($itemStock as $item) {
                $itemStock[$index++]->stock_id = $idStock;
            }
            $this->Stock_m->insertBatch($itemStock);

            if ($this->db->affected_rows() > 0) {
                $keranjang = array("success" => true);
            } else {
                $keranjang = array("success" => false);
            }
            echo json_encode($keranjang);
        } else if (isset($_POST['proses_out'])) {
            $idStock = $this->Stock_m->insertGetId($stock);
            $index = 0;
            foreach ($itemStock as $item) {
                $itemStock[$index++]->stock_id = $idStock;
            }
            $this->Stock_m->insertBatchOut($itemStock);

            if ($this->db->affected_rows() > 0) {
                $keranjang = array("success" => true);
            } else {
                $keranjang = array("success" => false);
            }
            echo json_encode($keranjang);
        }
    }

    public function stockMinimum()
    {
        $result = userData(); //fungsi_helper
        $minimum = $this->Stock_m->stockMinimum()->result();
        $data = array(
            "title" => "Detail Stock",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/stock/v_stock_minimum",
            "minimum" => $minimum,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function print($id)
    {
        $result = userData(); //fungsi_helper
        $stock = $this->Stock_m->getJoinStockIn($id);
        $stockIn = $this->Stock_m->getJoinStockInItem($id);
        $stockOut = $this->Stock_m->getJoinStockOut($id);
        $data = array(
            "title" => "Print Stock",
            "result" => $result['user'],
            "topbar" => "tamplates/topbar",
            "sidebar" => "tamplates/sidebar",
            "page" => "transaksi/stock/print_stock",
            "stock" => $stock,
            "stockIn" => $stockIn,
            "stockOut" => $stockOut,
        );
        $this->load->view('tamplates/main', $data);
    }

    public function getBarangStock()
    {
        $id = $this->input->post('id_barang');
        $data = $this->Stock_m->get_stock($id);
        echo json_encode($data);
    }
}

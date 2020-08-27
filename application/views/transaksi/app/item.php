<?php
foreach ($cart as $ca) { ?>
    <tr>
        <td><?= $ca->kode ?></td>
        <td><?= $ca->nama ?></td>
        <th class="barang_harga" id="barang_harga"><?= $ca->harga ?></th>
        <td id="qty_item"><?= $ca->qty ?></td>
        <td id="subTotal"><?= $ca->total ?></td>
        <td>
            <button class="btn btn-sm btn-danger hapus" data-id="<?= $ca->cart_id ?>"><i class="fas fa-fw fa-trash-alt"></i></button>
        </td>
    </tr>
<?php } ?>
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        DB::statement('CREATE PROCEDURE IF NOT EXISTS sp_get_buy_data(IN id_param INT)
        BEGIN
            SELECT buys.quantity, buys.price
            FROM inventory
            JOIN inventory_entry ON inventory_entry.id = inventory.entrance_id
            JOIN buys ON buys.id = inventory_entry.buys_id
            WHERE inventory.id = id_param;
        END;');

        DB::statement('CREATE PROCEDURE IF NOT EXISTS sp_get_inventory_return(IN id_param INT)
            BEGIN
                SELECT inventory_return.id, suppliers.name_supplier,
                inventory_return.products, inventory_return.quantity,
                inventory_return.support_document, inventory_return.observations,
                inventory_state.name_state_inventory
                FROM inventory_return
                INNER JOIN suppliers ON suppliers.id = inventory_return.supplier_id
                INNER JOIN inventory_state ON inventory_state.id = inventory_return.state_id
                WHERE inventory_return.id = id_param;
            END;');

        DB::statement('CREATE PROCEDURE IF NOT EXISTS sp_get_inventory(IN id_param INT)
            BEGIN
                SELECT inventory.code, inventory.name_inventory,inventory.stock,
                buys.price, inventory_entry.supplier_price, suppliers.nit,
                suppliers.name_supplier, suppliers.phone, suppliers.cell_phone,
                suppliers.address, state_buys.name_state_buys, inventory.created_at
                FROM inventory
                INNER JOIN inventory_entry ON inventory_entry.id = inventory.entrance_id
                INNER JOIN suppliers ON suppliers.id = inventory_entry.supplier_id
                INNER JOIN state_buys ON state_buys.id = inventory_entry.state_id
                INNER JOIN buys ON buys.id = inventory_entry.buys_id
                WHERE inventory.id = id_param;
            END;');

        DB::statement('CREATE PROCEDURE IF NOT EXISTS sp_get_detail_products(IN id_param INT)
        BEGIN
            SELECT buys.quantity, buys.price
            FROM inventory
            INNER JOIN inventory_entry ON inventory_entry.id = inventory.entrance_id
            INNER JOIN buys ON buys.id = inventory_entry.buys_id
            WHERE inventory.id = id_param;
        END;');

        DB::statement('CREATE PROCEDURE IF NOT EXISTS sp_inventory_export(IN id_param INT)
        BEGIN
            SELECT
            inventory.id,
            inventory.code,
            inventory.name_inventory,
            inventory.stock,
            inventory_entry.supplier_price,
            inventory.created_at
            FROM
            inventory
            JOIN
            inventory_entry ON inventory_entry.id = inventory.entrance_id
            WHERE
            inventory.id = id_param;
        END;');

        DB::statement('CREATE PROCEDURE IF NOT EXISTS sp_get_sale_PDF(IN id_param INT)
        BEGIN
            SELECT
                users.name,
                sales.id,
                sales.id_sales_check,
                sales.observations,
                Payment_Method.PaymentMethod,
                sales_detail.products,
                sales_detail.quantity,
                sales_detail.price,
                sales_detail.discount,
                sales_receipt.name_receipt,
                customer.name_customer,
                customer.email,
                customer.cell_phone,
                customer.phone,
                customer.adress,
                customer.country,
                customer.departament,
                customer.city,
                sales.created_at
            FROM sales
            JOIN Payment_Method ON Payment_Method.id = sales.payment_method_id
            JOIN users ON users.id = sales.user_id
            JOIN customer ON customer.id = sales.customer_id
            JOIN sales_detail ON sales_detail.id = sales.sale_id
            JOIN sales_receipt ON sales.receipt_sales_id = sales_receipt.id
            WHERE sales.id = id_param;
        END;');

        //DB::statement('');
        //DB::statement('');
        //DB::statement('');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('DROP PROCEDURE IF EXISTS getBuyData');
        Schema::dropIfExists('DROP PROCEDURE IF EXISTS get_inventory_return');
        Schema::dropIfExists('DROP PROCEDURE IF EXISTS get_inventory');
        Schema::dropIfExists('DROP PROCEDURE IF EXISTS GetDetailProductos');
        Schema::dropIfExists('DROP PROCEDURE IF EXISTS InventoryExport');
        Schema::dropIfExists('DROP PROCEDURE IF EXISTS GetSalePDF');
    }

}

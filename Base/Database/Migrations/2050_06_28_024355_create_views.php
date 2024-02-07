<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        DB::statement('CREATE VIEW IF NOT EXISTS view_CalculateSalesLastWeek AS
        SELECT
            SUM(CAST(REPLACE(REPLACE(REPLACE(price, ",", ""), "$", ""), " ", "") AS DECIMAL(10, 2))) AS total_sales
        FROM
            sales
            JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE
        sales.created_at BETWEEN DATE_SUB(CURDATE(), INTERVAL 8 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)');

        DB::statement('CREATE VIEW IF NOT EXISTS view_CalculateSalesDaily AS
        SELECT
            SUM(CAST(REPLACE(REPLACE(REPLACE(sales_detail.price, ",", ""), "$", ""), " ", "") AS DECIMAL(10, 2))) AS total_sales
        FROM
            sales
            JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE
            CAST(sales.created_at AS DATE) = CURDATE()');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ReturnInventory AS
        SELECT
        inventory_return.id AS id,
        suppliers.name_supplier AS name_supplier,
        inventory_return.products AS products,
        inventory_return.quantity AS quantity,
        inventory_return.observations AS observations,
        inventory_return.support_document AS support_document,
        inventory_state.name_state_inventory AS name_state
        FROM
        inventory_return
        JOIN
        suppliers ON suppliers.id = inventory_return.supplier_id
        JOIN
        inventory_state ON inventory_state.id = inventory_return.state_id;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultProducts AS
        SELECT
        products.id,
            products.sku,
            products.imagen,
            products.name_products,
            category.name_category,
            tags.name_tags,
            products.quantities,
            products.price,
            products.state_id,
            products.category_id,
            products.tags_id,
            products.inventory_min,
            products.manufacturer_id,
            products.description_products
        FROM
        products
            JOIN category ON category.id = products.category_id
            JOIN tags ON tags.id = products.tags_id;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultSales AS
        SELECT
        sales.id,
        Payment_Method.PaymentMethod,
        customer.name_customer,
        sales_detail.price,
        products.name_products,
        products.description_products,
        sales_receipt.name_receipt,
        sales.created_at
        FROM
        sales
            JOIN sales_receipt ON sales_receipt.id = sales.receipt_sales_id
            JOIN sales_detail ON sales_detail.id = sales.sale_id
            JOIN sales_state ON sales_state.id = sales.sale_state_id
            JOIN products ON products.id = sales.products_id
            JOIN customer ON customer.id = sales.customer_id
            JOIN Payment_Method ON Payment_Method.id = sales.payment_method_id;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationSalesMonday AS
        SELECT COUNT(*) AS total_sales
        FROM sales
        INNER JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE DATE(sales.created_at) >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
        AND DATE(sales.created_at) < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 1 DAY)
        AND DAYOFWEEK(sales.created_at) = 2;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationSaleTuesday AS
        SELECT COUNT(*) AS total_sales
        FROM sales
        INNER JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE DATE(sales.created_at) >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 1 DAY)
        AND DATE(sales.created_at) < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 1 DAY), INTERVAL 1 DAY)
        AND DAYOFWEEK(sales.created_at) = 3;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationSaleWednesday AS
        SELECT COUNT(*) AS total_sales
        FROM sales
        INNER JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE DATE(sales.created_at) >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 2 DAY)
        AND DATE(sales.created_at) < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 2 DAY), INTERVAL 1 DAY)
        AND DAYOFWEEK(sales.created_at) = 4;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationSaleThursday AS
        SELECT COUNT(*) AS total_sales
        FROM sales
        INNER JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE DATE(sales.created_at) >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 3 DAY)
        AND DATE(sales.created_at) < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 3 DAY), INTERVAL 1 DAY)
        AND DAYOFWEEK(sales.created_at) = 5;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationSaleFriday AS
        SELECT COUNT(*) AS total_sales
        FROM sales
        INNER JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE DATE(sales.created_at) >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 4 DAY)
        AND DATE(sales.created_at) < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 4 DAY), INTERVAL 1 DAY)
        AND DAYOFWEEK(sales.created_at) = 6;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationSaleSaturday AS
        SELECT COUNT(*) AS total_sales
        FROM sales
        INNER JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE DATE(sales.created_at) >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 5 DAY)
        AND DATE(sales.created_at) < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 5 DAY), INTERVAL 1 DAY)
        AND DAYOFWEEK(sales.created_at) = 7;');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationSaleSunday AS
        SELECT COUNT(*) AS total_sales
        FROM sales
        INNER JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE DATE(sales.created_at) >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
        AND DATE(sales.created_at) < DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) - 6 DAY), INTERVAL 1 DAY)
        AND DAYOFWEEK(sales.created_at) = 1;');

        DB::statement("CREATE VIEW IF NOT EXISTS view_ConsultationSaleMonth AS
        SELECT SUM(CAST(REPLACE(REPLACE(REPLACE(sales_detail.price, ',', ''), '$', ''), ' ', '') AS DECIMAL(10, 2))) AS total_sales
        FROM sales
        INNER JOIN sales_detail ON sales_detail.id = sales.sale_id
        WHERE sales.created_at BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND LAST_DAY(NOW());");

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationSaleYear AS
        SELECT
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 1 THEN 1 ELSE 0 END), 0) AS `Enero`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 2 THEN 1 ELSE 0 END), 0) AS `Febrero`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 3 THEN 1 ELSE 0 END), 0) AS `Marzo`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 4 THEN 1 ELSE 0 END), 0) AS `Abril`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 5 THEN 1 ELSE 0 END), 0) AS `Mayo`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 6 THEN 1 ELSE 0 END), 0) AS `Junio`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 7 THEN 1 ELSE 0 END), 0) AS `Julio`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 8 THEN 1 ELSE 0 END), 0) AS `Agosto`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 9 THEN 1 ELSE 0 END), 0) AS `Septiembre`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 10 THEN 1 ELSE 0 END), 0) AS `Octubre`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 11 THEN 1 ELSE 0 END), 0) AS `Noviembre`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 12 THEN 1 ELSE 0 END), 0) AS `Diciembre`
        FROM `Bank_Transactions` WHERE `transaction_type` = "Ventas";');

        DB::statement('CREATE VIEW IF NOT EXISTS view_ConsultationBuyYear AS
        SELECT
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 1 THEN 1 ELSE 0 END), 0) AS `Enero`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 2 THEN 1 ELSE 0 END), 0) AS `Febrero`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 3 THEN 1 ELSE 0 END), 0) AS `Marzo`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 4 THEN 1 ELSE 0 END), 0) AS `Abril`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 5 THEN 1 ELSE 0 END), 0) AS `Mayo`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 6 THEN 1 ELSE 0 END), 0) AS `Junio`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 7 THEN 1 ELSE 0 END), 0) AS `Julio`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 8 THEN 1 ELSE 0 END), 0) AS `Agosto`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 9 THEN 1 ELSE 0 END), 0) AS `Septiembre`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 10 THEN 1 ELSE 0 END), 0) AS `Octubre`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 11 THEN 1 ELSE 0 END), 0) AS `Noviembre`,
            IFNULL(SUM(CASE WHEN MONTH(`created_at`) = 12 THEN 1 ELSE 0 END), 0) AS `Diciembre`
        FROM `Bank_Transactions` WHERE `transaction_type` = "Gastos";');

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
        DB::statement('DROP VIEW IF EXISTS CalculateSalesLastWeek');
        DB::statement('DROP VIEW IF EXISTS CalculateSalesDaily');
        DB::statement('DROP VIEW IF EXISTS ReturnInventory');

        DB::statement('DROP VIEW IF EXISTS ConsultProducts');
        DB::statement('DROP VIEW IF EXISTS ConsultSales');
        DB::statement('DROP VIEW IF EXISTS ConsultationSalesMonday');
        DB::statement('DROP VIEW IF EXISTS ConsultationSaleTuesday');

        DB::statement('DROP VIEW IF EXISTS ConsultationSaleWednesday');
        DB::statement('DROP VIEW IF EXISTS ConsultationSaleThursday');
        DB::statement('DROP VIEW IF EXISTS ConsultationSaleFriday');
        DB::statement('DROP VIEW IF EXISTS ConsultationSaleSaturday');
        DB::statement('DROP VIEW IF EXISTS ConsultationSaleSunday');
        DB::statement('DROP VIEW IF EXISTS ConsultationSaleMonth');
        DB::statement('DROP VIEW IF EXISTS ConsultationSaleYear');

        DB::statement('DROP VIEW IF EXISTS ConsultationBuyYear');
    }


}

ALTER TABLE `customer_payment` CHANGE `amount` `amount` DOUBLE(10,2) NULL DEFAULT NULL;
ALTER TABLE `erp_invoice` ADD `taxable_price` FLOAT(10,2) NOT NULL AFTER `igst_price`;
ALTER TABLE `erp_invoice_details` ADD `taxable_cost` FLOAT(10,2) NOT NULL AFTER `igst`;
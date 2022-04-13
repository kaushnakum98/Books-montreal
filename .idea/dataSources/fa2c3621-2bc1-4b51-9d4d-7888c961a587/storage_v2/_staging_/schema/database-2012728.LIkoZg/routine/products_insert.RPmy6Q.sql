create
    definer = `user-2012728`@localhost procedure products_insert(IN p_productid varchar(50),
                                                                 IN p_description varchar(100),
                                                                 IN p_price decimal(4, 2),
                                                                 IN p_costprice decimal(10, 2))
BEGIN

INSERT INTO products (product_code,description,price,cost_price) VALUES 
(p_productid,p_description,p_price,p_costprice);

END;


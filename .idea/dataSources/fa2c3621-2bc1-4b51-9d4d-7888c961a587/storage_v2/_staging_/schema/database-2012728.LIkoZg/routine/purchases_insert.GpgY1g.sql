create
    definer = `user-2012728`@localhost procedure purchases_insert(IN p_product_code varchar(50), IN p_username char(12),
                                                                  IN p_quantity int, IN p_comments varchar(200))
BEGIN

INSERT INTO purchases (product_id,username,quantity,comments)
VALUES (p_product_code,p_username,p_quantity,p_comments);

END;


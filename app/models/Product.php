<?php


    class Product
    {
       private $db;

       public function __construct()
       {
           $this->db = new Database();
       }

       public function getProducts($limit)
       {
           $this->db->query('select p.id as product_id, p.user_id, u.name as user_name,p.count, p.name, p.body, p.price, p.price_sale, p.soluong, p.image, p.created_at 
                                 from products p
                                 left join users u on u.id = p.user_id 
                                 order by p.created_at desc limit '.$limit);
           return $this->db->resultSet();

       }

       public function getProductById($id)
       {
           $this->db->query('select * from products where id = :id');
           $this->db->bind(':id',$id);
           return $this->db->single();
       }
    
    //     public function getPostByUserId($user_id)
    //     {
    //         $this->db->query('select count(*) as total from posts where user_id = :user_id');
    //         $this->db->bind(':user_id',$user_id);
    //         return $this->db->single();
    //     }
       
       public function addProduct($data)
       {
           $this->db->query('INSERT INTO products (user_id,price, price_sale, soluong, image, name, body) values (:user_id, :price, :price_sale, :soluong, :image, :name, :body)');
           // Bind values
           $this->db->bind(':user_id', $data['user_id']);
           $this->db->bind(':price', $data['price']);
           $this->db->bind(':price_sale', $data['price_sale']);
           $this->db->bind(':soluong',$data['soluong']);
           $this->db->bind(':image',$data['image']);
           $this->db->bind(':name', $data['name']);
           $this->db->bind(':body', $data['body']);

           // Execute
           if( $this->db->execute() ){
               return true;
           } else {
               return false;
           }
       }

       public function updateProduct($data)
       {
           $this->db->query('UPDATE products SET price = :price, price_sale = :price_sale, soluong = :soluong, name = :name, body = :body where id = :id');
           // Bind values
           $this->db->bind(':id', $data['id']);
           $this->db->bind(':price', $data['price']);
           $this->db->bind(':price_sale', $data['price_sale']);
           $this->db->bind(':soluong', $data['soluong']);
           $this->db->bind(':name', $data['name']);
           $this->db->bind(':body', $data['body']);

           // Execute
           if( $this->db->execute() ){
               return true;
           } else {
               return false;
           }
       }

       public function deleteProduct($id)
       {
           $this->db->query('DELETE FROM products where id = :id');
           // Bind values
           $this->db->bind(':id', $id);

           // Execute
           if( $this->db->execute() ){
               return true;
           } else {
               return false;
           }
       }
    }
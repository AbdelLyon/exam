<?php

namespace Models;

class Home extends AbstractModel
{
   protected string $table = "velos";
   private int $id;
   private string $name;
   private string $description;
   private string $image;
   private int $price;


   public function getId(): ?int
   {
      return $this->id;
   }

   public function getName(): ?string
   {
      return $this->name;
   }

   public function setName(string $name): void
   {
      $this->name = $name;
   }

   public function getDescription(): ?string
   {
      return $this->description;
   }

   public function setDescription(string $description): void
   {
      $this->description = $description;
   }

   public function getImage(): ?string
   {
      return $this->image;
   }

   public function setImage(string $image): void
   {
      $this->image = $image;
   }

   public function getPrice(): ?int
   {
      return $this->price;
   }

   public function setPrice(string $price): void
   {
      $this->price = $price;
   }


   /**
    * ajoute un nouveau velo dans la BDD
    * @param objetc $velo
    * @return int id velo
    */

   public function save(object $velo): int
   {
      $statementSave = $this->pdo->prepare("INSERT INTO $this->table (name, description, image, price) VALUES (:name, :description, :image, :price)");
      $statementSave->execute([
         'name' => $velo->getName(),
         'description' => $velo->getDescription(),
         'image' => $velo->getImage(),
         'price' => $velo->getPrice()

      ]);
      return $this->pdo->lastInsertId();
   }


   /**
    * edite un velo dans la base de données
    * @param integer $Id
    * @param object $velo
    * @return void
    */

   public function edit(int $id, object $velo): void
   {
      $statementEdit = $this->pdo->prepare("UPDATE $this->table SET name = :name, image = :image, description = :description, price = :price WHERE id = :velo_id");
      $statementEdit->execute([
         "velo_id" => $id,
         'name' => $velo->getName(),
         'description' => $velo->getDescription(),
         'image' => $velo->getImage(),
         "price" => $velo->getPrice()
      ]);
   }
}

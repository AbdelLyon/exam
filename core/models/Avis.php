<?php

namespace Models;

class Avis extends AbstractModel
{
   protected string $table = "avis";
   private int $id;
   private string $author;
   private string $content;
   private int $velo_id;

   public function getId(): ?int
   {
      return $this->id;
   }

   public function getAuthor(): ?string
   {
      return $this->author;
   }

   public function setAuthor(string $author): void
   {
      $this->author = $author;
   }

   public function getContent(): ?string
   {
      return $this->content;
   }

   public function setContent(string $content): void
   {
      $this->content = $content;
   }

   public function getVeloId(): ?int
   {
      return $this->velo_id;
   }

   public function setVeloId(int $veloId): void
   {
      $this->velo_id = $veloId;
   }

   /**
    * trouve tous les commentaires associés à un cocktail
    * @param int $velo_id
    * @return array|bool 
    */

   public function findAllByVelo(int $veloId): array | bool
   {
      $requete = $this->pdo->prepare("SELECT * FROM $this->table WHERE velo_id = :velo_id");
      $requete->execute(["velo_id" => $veloId]);
      return $requete->fetchAll(\PDO::FETCH_CLASS, get_class($this));
   }

   /**
    * enregistre un commentaire dans la base de données
    * @param string $author
    * @param string $content
    * @param integer $veloId
    */

   public function save(object $instance): void
   {
      $statementSave = $this->pdo->prepare("INSERT INTO $this->table (author, content, velo_id) VALUES (:author, :content, :velo_id)");
      $statementSave->execute([
         "author" => $instance->getAuthor(),
         "content" => $instance->getContent(),
         "velo_id" => $instance->getVeloId()
      ]);
   }


   /**
    * edite un velo dans la base de données
    * @param integer $Id
    * @param object $avis
    * @return void
    */

   public function edit(int $id, object $avis): void
   {
      $statementEdit = $this->pdo->prepare("UPDATE $this->table SET author = :author, content = :content, velo_id = :velo_id WHERE id = :velo_id");
      $statementEdit->execute([
         'author' => $avis->getAuthor(),
         'content' => $avis->getContent(),
         "velo_id" => $id
      ]);
   }
}

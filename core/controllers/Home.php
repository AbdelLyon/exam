<?php

namespace Controllers;

use Models\Avis;
use Models\Home as ModelsHome;

class Home extends AbstractController
{
   protected string $modelName = ModelsHome::class;

   /**
    * affiche l'accueil 
    *@return void
    */

   public function index(): void
   {

      $velos = $this->model->findAll();
      $pageTitle = "Accueil";
      $this->render("home/index", compact('pageTitle', 'velos'));
   }

   /**
    * creer un vélo 
    * @return void
    */

   public function new(): void
   {

      $name = null;
      $description = null;
      $image = null;
      $price = null;

      if (!empty($_POST['name'])) $name = htmlspecialchars($_POST['name']);
      if (!empty($_POST['description'])) $description = htmlspecialchars($_POST['description']);
      if (!empty($_POST['image'])) $image = htmlspecialchars($_POST['image']);
      if (!empty($_POST['price']) && ctype_digit($_POST['price']))  $price = $_POST['price'];


      if ($name && $description && $image && $price) {

         $velo = new ModelsHome();

         $velo->setName($name);
         $velo->setDescription($description);
         $velo->setImage($image);
         $velo->setPrice($price);

         $id = $this->model->save($velo);
         $this->redirect([
            "action" => "show",
            "id" => $id
         ]);
      };

      $pageTitle = "Nouveau velo";
      $this->render("home/create", compact('pageTitle'));
   }

   /**
    * afficher un velo et ses commentaires
    * @return void
    */

   public function show(): void
   {
      $id = null;

      if (!empty($_GET['id']) && ctype_digit($_GET['id'])) $id = $_GET['id'];
      if (!$id) $this->redirect();

      $velo = $this->model->findById($id);

      if (!$velo) $this->redirect();

      $modelAvis = new Avis();
      $avis =  $modelAvis->findAllByVelo($id);
      $pageTitle = $velo->getName();

      $this->render("home/show", compact('pageTitle', 'velo', 'avis'));
   }


   /**
    * supprimer un velo par son ID et rediriger vers l'index des velos
    *@return void
    */

   public function delete(): void
   {
      $id = null;
      if (!empty($_POST['id']) && ctype_digit($_POST['id'])) $id = $_POST['id'];

      if (!$id) $this->redirect(["info" => "noId"]);
      $velo = $this->model->findById($id);

      if (!$velo) $this->redirect();

      $this->model->remove($velo);
      $this->redirect(["info" => "deleted"]);
   }


   /**
    * editer un velo 
    * @return void
    */

   public function edit(): void
   {
      $id = null;
      $name = null;
      $description = null;
      $image = null;
      $price = null;

      // Valider le velo édité
      if ($_SERVER['REQUEST_METHOD'] === "POST") {
         if (!empty($_POST['id']) && ctype_digit($_POST['id'])) $id = $_POST['id'];
         if (!empty($_POST['name'])) $name = htmlspecialchars($_POST['name']);
         if (!empty($_POST['image'])) $image = htmlspecialchars($_POST['image']);
         if (!empty($_POST['description'])) $description = htmlspecialchars($_POST['description']);
         if (!empty($_POST['price']) && ctype_digit($_POST['price'])) $price = $_POST['price'];


         if ($id && $name && $image && $description && $price) {

            $velo = new ModelsHome();
            $velo->setName($name);
            $velo->setImage($image);
            $velo->setDescription($description);
            $velo->setPrice($price);


            $this->model->edit($id, $velo);
         }

         $this->redirect([
            "action" => "show",
            "id" => $id
         ]);
      }

      // Récuperer le velo à éditer
      if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
         $id = $_GET['id'];
         $velo = $this->model->findById($id);
         if (!$velo) $this->redirect();
         $pageTitle = "Modifier {$velo->getName()}";
         $this->render("home/edit", compact('pageTitle', 'velo'));
      } else {
         $this->redirect(["info" => "noId"]);
      }
   }
}

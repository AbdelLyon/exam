<form class="w-50" method="post" action="/?=type=home&action=edit">
   <div class=" form-floating mb-2">
      <input type="text" class="form-control" name="name" value="<?= $velo->getName() ?>">
      <label for="floatingTextarea2">Nom</label>
   </div>
   <div class="form-floating mb-2">
      <input type="text" class="form-control" name="description" value="<?= $velo->getDescription() ?>">
      <label for="floatingTextarea2">Ingrédients</label>
   </div>
   <div class="form-floating mb-2">
      <input type="text" class="form-control" name="image" value="<?= $velo->getImage() ?>">
      <label for="floatingTextarea2">image</label>
   </div>
   <div class="form-floating mb-2">
      <input type="text" class="form-control" name="price" value="<?= $velo->getPrice() ?>">
      <label for="floatingTextarea2">image</label>
   </div>

   <div class="d-flex justify-content-end align-items-center">
      <button class="btn p-0" name="id" value="<?= $velo->getId() ?>"><i class="text-success fs-5 far fa-plus-square"></i></button>
   </div>
</form>
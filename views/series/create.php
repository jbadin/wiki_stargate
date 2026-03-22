<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
</svg>

<?php if (!empty($this->formSuccess)) { ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            <?= $this->formSuccess ?>
        </div>
    </div>
<?php } ?>

<?php if (!empty($this->errors['form'])) { ?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
            <?= $this->errors['form'] ?>
        </div>
    </div>
<?php } ?>

<div class="row justify-content-center">
    <div class="col-6">
        <h1><?= $_SERVER['REQUEST_URI'] == '/create-series' ? 'Créer une série' : 'Modifier une série' ?></h1>
        <form action="/create-series" method="POST" enctype="multipart/form-data">
            <hr>
            <div class="mb-2">
                <label for="name" class="fw-bold">Nom</label>
                <input type="text" class="form-control <?= !empty($this->errors['name']) ? 'is-invalid' : '' ?>"
                    id="name" name="name" placeholder="Stargate SG-1"
                    value="<?= !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
                <p class="invalid-feedback"><?= @$this->errors['name'] ?></p>
            </div>
            <div class="mb-2">
                <label for="short_name" class="fw-bold">Raccourci</label>
                <input type="text" class="form-control <?= !empty($this->errors['short_name']) ? 'is-invalid' : '' ?>"
                    id="short_name" name="short_name" placeholder="SG-1"
                    value="<?= !empty($_POST['short_name']) ? htmlspecialchars($_POST['short_name']) : '' ?>">
                <p class="invalid-feedback"><?= @$this->errors['short_name'] ?></p>
            </div>
            <div class="mb-2">
                <label for="start_year" class="fw-bold">Année de lancement</label>
                <input type="number" minlength="4" maxlength="4"
                    class="form-control <?= !empty($this->errors['start_year']) ? 'is-invalid' : '' ?>" id="start_year"
                    name="start_year" placeholder="1997"
                    value="<?= !empty($_POST['start_year']) ? htmlspecialchars($_POST['start_year']) : '' ?>">
                <p class="invalid-feedback"><?= @$this->errors['start_year'] ?></p>
            </div>
            <div class="mb-2">
                <label for="end_year" class="fw-bold">Année de fin</label>
                <input type="number" minlength="4" maxlength="4"
                    class="form-control <?= !empty($this->errors['end_year']) ? 'is-invalid' : '' ?>" id="end_year"
                    name="end_year" placeholder="2007"
                    value="<?= !empty($_POST['end_year']) ? htmlspecialchars($_POST['end_year']) : '' ?>">
                <p class="invalid-feedback"><?= @$this->errors['end_year'] ?></p>
            </div>
            <div class="mb-2">
                <label for="img" class="fw-bold">Affiche de la série</label>
                <input type="file" class="form-control <?= !empty($this->errors['img']) ? 'is-invalid' : '' ?>" id="img"
                    name="img" placeholder="Image de la série">
                <p class="invalid-feedback"><?= @$this->errors['img'] ?></p>
            </div>
            <div class="mb-2">
                <label for="description" class="fw-bold">Description</label>
                <textarea rows="15"
                    class="form-control h-100 <?= !empty($this->errors['description']) ? 'is-invalid' : '' ?>"
                    placeholder="Description" id="description"
                    name="description"><?= !empty($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
                <p class="invalid-feedback"><?= @$this->errors['description'] ?></p>
            </div>
            <div class="d-grid">
                <input type="submit" value="Créer" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
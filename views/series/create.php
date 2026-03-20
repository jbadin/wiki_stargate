<div class="row justify-content-center">
    <div class="col-6">
        <h1>Créer une série</h1>
        <form action="/create-series" method="POST">
            <!-- <input type="email" class="form-control is-invalid" id="floatingInputInvalid" placeholder="name@example.com"
                value="test@example.com">
            <label for="floatingInputInvalid">Invalid input</label> -->
            <hr>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="name" placeholder="Stargate SG-1">
                <label for="name">Nom</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="short_name" placeholder="SG-1">
                <label for="short_name">Raccourci</label>
            </div>
            <div class="form-floating mb-2">
                <input type="number" minlength="4" maxlength="4" class="form-control" id="start_year"
                    placeholder="1997">
                <label for="start_year">Année de lancement</label>
            </div>
            <div class="form-floating mb-2">
                <input type="number" minlength="4" maxlength="4" class="form-control" id="end_year" placeholder="2007">
                <label for="end_year">Année de lancement</label>
            </div>
            <div class="form-floating mb-2">
                <textarea rows="15" class="form-control h-100" placeholder="Description" id="description"></textarea>
                <label for="description">Description</label>
            </div>
            <div class="d-grid">
                <input type="submit" value="Créer" class="btn btn-success">
            </div>
        </form>
    </div>
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <form action="<?= BASEURL; ?>/user/update" method="post">
                <input type="hidden" name="id" value="<?= $data['usr']['id']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $data['usr']['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $data['usr']['email']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>
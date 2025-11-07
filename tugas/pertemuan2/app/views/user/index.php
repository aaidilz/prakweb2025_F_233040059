<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                Tambah User
            </button>
            <h3>Daftar User</h3>
            <ul class="list-group">
                <?php foreach ($data['usr'] as $usr) : ?>
                    <li class="list-group-item">
                        <?= $usr['name']; ?>
                        <a href="<?= BASEURL; ?>/user/delete/<?= $usr['id']; ?>" class="badge bg-danger float-end ms-1" onclick="return confirm('yakin?');">hapus</a>
                        <a href="<?= BASEURL; ?>/user/edit/<?= $usr['id']; ?>" class="badge bg-success float-end ms-1 tampilModalUbah" data-bs-toggle="modal" data-bs-target="#formModal" data-id="<?= $usr['id']; ?>">ubah</a>
                        <a href="<?= BASEURL; ?>/user/detail/<?= $usr['id']; ?>" class="badge bg-primary float-end ms-1">detail</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/user/store" method="post" id="formUser">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="formUser" class="btn btn-primary">Tambah Data</button>
            </div>
        </div>
    </div>
</div>
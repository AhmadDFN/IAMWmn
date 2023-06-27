@extends('layouts.template')

@section('title', $title)
@section('page-title', $page)

@section('content')

    <div class="bg-secondary rounded">
        @if (session('text'))
            <div class="alert alert-{{ session('type') }} text-center" style="width: 300px;" role="alert">
                {{ session('text') }}
            </div>
        @endif
    </div>

    <div class="col-md-5">
        <div class="profile-header">
            <div class="overlay"></div>
            <div class="profile-main">
                <img src="<?= $auth['image_url'] !== null ? 'file/gambar/' . $auth['image_url'] : 'assets/img/admin.png' ?>"
                    class="img-circle" width="100">
                <h3 class="name"><?= $auth['nama_lengkap'] !== null ? $auth['nama_lengkap'] : $auth['email'] ?></h3>
                <span class="online-status status-available">Aktif</span>
            </div>
        </div>
        <div class="profile-detail">
            <div class="profile-info">
                <h4><i class="fa fa-user box-circle"></i> Informasi Dasar</h4>
                <div class="row">
                    <div class="col-md-4">NIK</div>
                    <div class="col-md-8">: <?= $auth['nik'] !== null ? $auth['nik'] : '-' ?></div>
                    <div class="col-md-4">Nama</div>
                    <div class="col-md-8">: <?= $auth['nama_lengkap'] !== null ? $auth['nama_lengkap'] : '-' ?></div>
                    <div class="col-md-4">Tanggal Lahir</div>
                    <div class="col-md-8">: <?= date('d F Y', strtotime($auth['tgl_lahir'])) ?></div>
                    <div class="col-md-4">Alamat</div>
                    <div class="col-md-8">: <?= $auth['alamat'] ?></div>
                    <div class="col-md-4">Jenis Kelamin</div>
                    <div class="col-md-8">:
                        <?= $auth['jenis_kelamin'] !== null ? ($auth['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan') : '-' ?>
                    </div>
                    <div class="col-md-4">Email</div>
                    <div class="col-md-8">: <?= $auth['email'] !== null ? $auth['email'] : '-' ?></div>
                    <div class="col-md-4">No Hp</div>
                    <div class="col-md-8">: <?= $auth['no_hp'] !== null ? $auth['no_hp'] : '-' ?></div>
                    <div class="col-md-4">Last Login</div>
                    <div class="col-md-8">: <?= $auth['login_terakhir'] !== null ? $auth['login_terakhir'] : '-' ?></div>
                </div>
            </div>
            <div class="profile-info">
                <h4><i class="fa fa-briefcase box-circle"></i> Pemberkasan</h4>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $presentasi ?>" aria-valuemin="0"
                        aria-valuemax="100" style="width: <?= $presentasi ?>%">
                        <?= $presentasi > 0 ? $presentasi . ' %' : '' ?>
                    </div>
                </div>
                <?php var_dump($presentasi); ?>
                <ul>
                    <li>KTP Upload
                        <?= $pemberkasan[2] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?>
                    </li>
                    <li>Kartu Keluarga Upload
                        <?= $pemberkasan[3] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?>
                    </li>
                    <li>Ijazah / SKL Upload
                        <?= $pemberkasan[4] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?>
                    </li>
                    <li>SKCK Upload
                        <?= $pemberkasan[5] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?>
                    </li>
                    <li>Surat Keterangan Domisili Upload
                        <?= $pemberkasan[6] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?>
                    </li>
                    <li>CV Upload
                        <?= $pemberkasan[7] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <form action="?page=profil" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $auth['id'] ?>">
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>NIK</label>
                        <input class="form-control" type="text" name="nik" placeholder="isikan nik anda ..."
                            value="<?= $auth['nik'] ?>" maxlength="16" autocomplete="OFF">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Nama Lengkap</label>
                        <input class="form-control" type="text" name="namalengkap"
                            placeholder="isikan nama lengkap anda ..." value="<?= $auth['nama_lengkap'] ?>"
                            autocomplete="OFF">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Tanggal Lahir</label>
                        <input class="form-control" type="date" name="tgllahir"
                            placeholder="isikan nama lengkap anda ..."
                            value="<?= date('Y-m-d', strtotime($auth['tgl_lahir'])) ?>" autocomplete="OFF">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat"><?= $auth['alamat'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jeniskelamin">
                            <option value="L" <?= $auth['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-Laki
                            </option>
                            <option value="P" <?= $auth['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email"
                            placeholder="isikan alamat email anda ..." value="<?= $auth['email'] ?>" autocomplete="OFF">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>No HP</label>
                        <input class="form-control" type="text" name="nohp" placeholder="isikan no hp anda ..."
                            value="<?= $auth['no_hp'] ?>" maxlength="12" autocomplete="OFF">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Password</label>
                        <input id="password-field" name="password" maxlength="10" type="password" class="form-control"
                            value="<?= $auth['password'] ?>" autocomplete="OFF">
                        <span toggle="#password-field" class="fa fa-eye-slash field-icon toggle-password"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Foto Profil</label>
                        <?= $auth['image_url'] !== null ? '<p>' . $auth['image_url'] . ' <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">foto profil belum ada <i class="fa fa-remove"></i></span>' ?>
                        <input type="hidden" name="imageurlnow" value="<?= $auth['image_url'] ?>">
                        <input class="form-control" type="file" name="imageurl">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Kartu Tanda Penduduk (KTP) Upload</label>
                        <?= $pemberkasan[2] !== null ? '<p><a target="_blank" href="file/pemberkasan/' . $pemberkasan[2] . '">' . $pemberkasan[2] . '</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">ktp belum ada <i class="fa fa-remove"></i></span>' ?>
                        <input type="hidden" name="ktpfilenow" value="<?= $pemberkasan[2] ?>">
                        <input class="form-control" type="file" name="ktpfile">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Kartu Keluarga Upload</label>
                        <?= $pemberkasan[3] !== null ? '<p><a target="_blank" href="file/pemberkasan/' . $pemberkasan[3] . '">' . $pemberkasan[3] . '</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">kartu keluarga belum ada <i class="fa fa-remove"></i></span>' ?>
                        <input type="hidden" name="kkfilenow" value="<?= $pemberkasan[3] ?>">
                        <input class="form-control" type="file" name="kkfile">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Ijazah / Surat Keterangan Lulus (SKL) Upload</label>
                        <?= $pemberkasan[4] !== null ? '<p><a target="_blank" href="file/pemberkasan/' . $pemberkasan[4] . '">' . $pemberkasan[4] . '</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">ijazah / skl belum ada <i class="fa fa-remove"></i></span>' ?>
                        <input type="hidden" name="ijazahfilenow" value="<?= $pemberkasan[4] ?>">
                        <input class="form-control" type="file" name="ijazahfile">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Surat Keterangan Catatan Kepolisian (SKCK) Upload</label>
                        <?= $pemberkasan[5] !== null ? '<p><a target="_blank" href="file/pemberkasan/' . $pemberkasan[5] . '">' . $pemberkasan[5] . '</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">skck belum ada <i class="fa fa-remove"></i></span>' ?>
                        <input type="hidden" name="skckfilenow" value="<?= $pemberkasan[5] ?>">
                        <input class="form-control" type="file" name="skckfile">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Surat Keterangan Domisili Upload</label>
                        <?= $pemberkasan[6] !== null ? '<p><a target="_blank" href="file/pemberkasan/' . $pemberkasan[6] . '">' . $pemberkasan[6] . '</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">surat keterangan domisili belum ada <i class="fa fa-remove"></i></span>' ?>
                        <input type="hidden" name="sdfilenow" value="<?= $pemberkasan[6] ?>">
                        <input class="form-control" type="file" name="sdfile">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div clas="form-group">
                        <label>Curriculum Vitae (CV) Upload</label>
                        <?= $pemberkasan[7] !== null ? '<p><a target="_blank" href="file/pemberkasan/' . $pemberkasan[7] . '">' . $pemberkasan[7] . '</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">CV belum ada <i class="fa fa-remove"></i></span>' ?>
                        <input type="hidden" name="cvfilenow" value="<?= $pemberkasan[7] ?>">
                        <input class="form-control" type="file" name="cvfile">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <div clas="form-group">
                        <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

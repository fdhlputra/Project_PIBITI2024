<x-layout title="User">

    <div class="container mt-4">
        <div class="d-flex mb-4 justify-content-end">
            <input type="text" class="form-control me-2" placeholder="Cari User..." style="width: 200px;">
            <a href="/users/create" class="btn btn-dark">Tambah</a>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover table-striped m-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Adrian</td>
                            <td>25</td>
                            <td>abc@example.com</td>
                            <td class="text-end">
                                <a href="/users/edit" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Renanda</td>
                            <td>20</td>
                            <td>abc@example.com</td>
                            <td class="text-end">
                                <a href="/users/edit" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Rifki</td>
                            <td>21</td>
                            <td>abc@example.com</td>
                            <td class="text-end">
                                <a href="/users/edit" class="btn btn-sm btn-primary">Edit</a>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>

{{--halaman dashboard utama supir --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Supir</title>
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <style>
    .btn-group {
      display: flex;
      gap: 10px;
    }
  </style>
</head>
<body class="bg-gradient-primary">
  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h4 text-gray-900">Dashboard Utama Supir</h1>
                <form action="{{ route('customer.logout') }}" method="POST" id="logoutForm">
                  @csrf
                  <button type="submit" class="btn btn-danger" onclick="return confirmLogout()">Logout</button>
                </form>
              </div>
              <div>
                <h2 class="h5 text-gray-900">Hi, {{ Auth::guard('customer')->user()->name }}</h2>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Id file</th>
                      <th>Nama file</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($files as $file)
                      <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->name }}</td>
                        <td>
                          <div class="btn-group">
                            <a href="{{ route('files.print', $file->id) }}" class="btn btn-primary">Print</a>
                            {{-- <form action="{{ route('files.markAsPrinted', $file->id) }}" method="POST" class="d-inline" onsubmit="return markAsPrinted(event)">
                              @csrf
                              <button type="submit" class="btn btn-success">Tandai Sudah di Print</button>
                            </form> --}}
                            <a href="{{ Storage::url($file->path) }}" class="btn btn-primary" target="_blank">Buka File</a>
                          </div>
                        </td>                      
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
  <script>
    function confirmLogout() {
      return confirm("Anda yakin ingin Logout?");
    }
  </script>
</body>
</html>

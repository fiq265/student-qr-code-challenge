<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Student QR</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">

        <div class="container text-start">

            <div class="row p-5">
                <div class="col">

                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                          {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                          {{ Session::get('error') }}
                        </div>
                    @endif

                    @error('upload_file')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <h1>Upload from file</h1>
                    <a href="{{ url('/template/Students Template.xlsx'); }}">Download excel template</a>

                    <div class="mt-5">
                        <form method="post" action="{{ route('upload.file') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                              <input class="form-control" name="upload_file" type="file" id="formFile">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Upload</button>      
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="mt-5">
                        <h3>All student data</h3>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Level</th>
                              <th scope="col">Class</th>
                              <th scope="col">Parents Contact</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($students as $student)
                                <tr>
                                  <th scope="row">{{ $student->name }}</th>
                                  <td>{{ $student->level }}</td>
                                  <td>{{ $student->class }}</td>
                                  <td>{{ $student->parent_contact }}</td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>

                </div>
            </div>
            
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>

@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class=" col-md-12">
    <h1>Programs</h1>
    <p class="form-text text-muted">See below the programs you have mapped using this tool. </p>
    <p class="form-text text-primary font-weight-bold"><i>Note:</i> If you are ideating/evaluating a course that is not
      associated with a specific program, use the "My Courses" tab instead.</p>



    <div class="card">
      @if(count($programs)>0)
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">Program</th>
            <th scope="col">Faculty and Department/School</th>
            <th scope="col">Level</th>
            <!-- <th scope="col">Status</th> -->
          </tr>
        </thead>
        <tbody>
          @foreach($programs as $program)
          <tr>
            <td><a href="{{route('programWizard.step1', $program->program_id)}}">{{$program->program}}</a></td>
            <td> {{$program->faculty}} <br>{{$program->department}}</td>
            <td> {{$program->level}} </td>
            {{-- <!-- <td>
              @if($program->status == -1)
              ❗Not configured
              @else
              ✔️Active
              @endif
            </td> --> --}}
          </tr>

          @endforeach

        </tbody>
      </table>

      @else
      <div class="card">
        <div class="card-header">
          You have no active programs
        </div>

      </div>


      @endif

    </div>

    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-primary btn-sm mt-2 col-2 float-right" data-toggle="modal"
          data-target="#createProgramModal">
          + Add Program
        </button>
      </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="createProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Program</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ action('ProgramController@store') }}">
            @csrf
            <div class="modal-body">


              <div class="form-group row">
                <label for="program" class="col-md-2 col-form-label text-md-right">Program Name</label>

                <div class="col-md-8">
                  <input id="program" type="text" class="form-control @error('program') is-invalid @enderror"
                    name="program" required autofocus>

                  @error('program')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="faculty" class="col-md-2 col-form-label text-md-right">Faculty/School</label>

                <div class="col-md-8">
                  <select id='faculty' class="custom-select" name="faculty" required>
                    <option disabled selected hidden>Open this select menu</option>
                    <option value="School of Engineering">School of Engineering</option>
                    <option value="Okanagan School of Education">Okanagan School of Education </option>
                    <option value="Faculty of Arts and Social Sciences">Faculty of Arts and Social Sciences </option>
                    <option value="Faculty of Creative and Critical Studies">Faculty of Creative and Critical Studies
                    </option>
                    <option value="Faculty of Science">Faculty of Science </option>
                    <option value="School of Health and Exercise Sciences">School of Health and Exercise Sciences
                    </option>
                    <option value="School of Nursing">School of Nursing </option>
                    <option value="School of Social Work">School of Social Work</option>
                    <option value="Faculty of Management">Faculty of Management</option>
                    <option value="Faculty of Medicine">Faculty of Medicine</option>
                    <option value="College of Graduate studies">College of Graduate studies</option>
                    <option value="Other">Other</option>
                  </select>

                  @error('faculty')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="department" class="col-md-2 col-form-label text-md-right">Department</label>

                <div class="col-md-8">
                  <select id="department" class="custom-select" name="department">
                    <option disabled selected hidden>Open this select menu</option>
                    <optgroup label="Faculty of Arts and Social Sciences ">
                      <option value="Community, Culture and Global Studies">Community, Culture and Global Studies
                      </option>
                      <option value="Economics, Philosophy and Political Science">Economics, Philosophy and Political
                        Science</option>
                      <option value="History and Sociology">History and Sociology</option>
                      <option value="Psychology">Psychology</option>
                    </optgroup>
                    <optgroup label="Faculty of Creative and Critical Studies ">
                      <option value="Creative Studies">Creative Studies</option>
                      <option value="Languages and World Literature">Languages and World Literature</option>
                      <option value="English and Cultural Studies">English and Cultural Studies</option>
                    </optgroup>
                    <optgroup label="Faculty of Science">
                      <option value="Biology">Biology</option>
                      <option value="Chemistry">Chemistry</option>
                      <option value="Computer Science, Mathematics, Physics and Statistics">Computer Science,
                        Mathematics, Physics and Statistics</option>
                      <option value="Earth, Environmental and Geographic Sciences">Earth, Environmental and Geographic
                        Sciences</option>
                    </optgroup>
                    <option value="Other">Other</option>

                  </select>

                  @error('department')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="level" class="col-md-2 col-form-label text-md-right">Level</label>
                <div class="col-md-6">

                  <div class="form-check ">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="level" value="Undergraduate" required>
                      Undegraduate
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="level" value="Graduate">
                      Graduate
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="level" value="Other">
                      Other
                    </label>
                  </div>
                </div>
              </div>

              <input type="hidden" class="form-check-input" name="user_id" value={{$user->id}}>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary col-2 btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary col-2 btn-sm">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {

    $("form").submit(function () {
      // prevent duplicate form submissions
      $(this).find(":submit").attr('disabled', 'disabled');
      $(this).find(":submit").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

    });
  });
</script>

@endsection
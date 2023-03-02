  @if(session('msg'))
  <div class="alert alert-success mt-4" role="alert">
      {{ session('msg') }}
  </div>
  @endif
    @if(session('msgf'))
  <div class="alert alert-danger mt-4" role="alert">
      {{ session('msgf') }}
  </div>
  @endif

  @if (!empty($mensagem))
  <div class="alert alert-success mt-4" role="alert">
      {{ $mensagem }}
  </div>
  @else
  @if ($errors->any())
  <div class="alert alert-danger mt-4">
      <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif
  @endif

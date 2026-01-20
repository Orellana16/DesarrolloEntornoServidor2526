<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Vendedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
    <h1 class="mb-4">Crear Nuevo Vendedor</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Errores de validación:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="max-width: 600px;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Datos del Vendedor</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('guardarVendedor') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                           name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nif" class="form-label">NIF *</label>
                    <input type="text" class="form-control @error('nif') is-invalid @enderror" 
                           name="nif" id="nif" value="{{ old('nif') }}" maxlength="9" required>
                    @error('nif')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_nac" class="form-label">Fecha de Nacimiento *</label>
                    <input type="date" class="form-control @error('fecha_nac') is-invalid @enderror" 
                           name="fecha_nac" id="fecha_nac" value="{{ old('fecha_nac') }}" required>
                    @error('fecha_nac')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo *</label>
                    <select class="form-select @error('sexo') is-invalid @enderror" name="sexo" id="sexo" required>
                        <option value="">-- Seleccionar --</option>
                        <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                        <option value="O" {{ old('sexo') == 'O' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('sexo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sueldo_base" class="form-label">Sueldo Base (€) *</label>
                    <input type="number" class="form-control @error('sueldo_base') is-invalid @enderror" 
                           name="sueldo_base" id="sueldo_base" value="{{ old('sueldo_base') }}" 
                           step="0.01" min="0" required>
                    @error('sueldo_base')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('listadoVendedores') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<div>
    <h2>Clientes</h2>

    @if (session()->has('mensaje'))
        <p class="ok">{{ session('mensaje') }}</p>
    @endif

    <div class="caja">
        <h3>{{ $cliente_id ? 'Editar cliente' : 'Nuevo cliente' }}</h3>

        <form wire:submit="guardar">
            <label>Nombre completo</label>
            <input type="text" wire:model="nombre_completo">
            @error('nombre_completo') <span class="error">{{ $message }}</span> @enderror

            <label>Correo electrónico</label>
            <input type="text" wire:model="correo">
            @error('correo') <span class="error">{{ $message }}</span> @enderror

            <label>Teléfono (opcional)</label>
            <input type="text" wire:model="telefono">
            @error('telefono') <span class="error">{{ $message }}</span> @enderror

            <label>Dirección (opcional)</label>
            <input type="text" wire:model="direccion">
            @error('direccion') <span class="error">{{ $message }}</span> @enderror

            <br><br>
            <button type="submit">{{ $cliente_id ? 'Actualizar' : 'Guardar' }}</button>
            @if ($cliente_id)
                <button type="button" wire:click="limpiar">Cancelar</button>
            @endif
        </form>
    </div>

    <div class="caja">
        <input type="text" wire:model.live="buscar" placeholder="Buscar cliente por nombre...">
        <br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Cuentas</th>
                <th>Saldo total</th>
                <th>Acciones</th>
            </tr>
            @forelse ($clientes as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->nombre_completo }}</td>
                    <td>{{ $c->correo }}</td>
                    <td>{{ $c->telefono }}</td>
                    <td>{{ $c->direccion }}</td>
                    <td>{{ $c->cuentas_count }}</td>
                    <td>Q {{ number_format($c->cuentas_sum_saldo ?? 0, 2) }}</td>
                    <td>
                        <button wire:click="editar({{ $c->id }})">Editar</button>
                        <button wire:click="eliminar({{ $c->id }})"
                                wire:confirm="¿Eliminar cliente y todas sus cuentas?">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No hay clientes registrados</td></tr>
            @endforelse
        </table>
    </div>
</div>
<div>
    <h2>Cuentas</h2>

    @if (session()->has('mensaje'))
        <p class="ok">{{ session('mensaje') }}</p>
    @endif

    <div class="caja">
        <h3>{{ $cuenta_id ? 'Editar cuenta' : 'Nueva cuenta' }}</h3>

        <form wire:submit="guardar">
            <label>Cliente</label>
            <select wire:model="cliente_id">
                <option value="">-- Seleccione --</option>
                @foreach ($clientes as $cl)
                    <option value="{{ $cl->id }}">{{ $cl->nombre_completo }}</option>
                @endforeach
            </select>
            @error('cliente_id') <span class="error">{{ $message }}</span> @enderror

            <label>Número de cuenta</label>
            <input type="text" wire:model="numero_cuenta">
            @error('numero_cuenta') <span class="error">{{ $message }}</span> @enderror

            <label>Tipo de cuenta</label>
            <select wire:model="tipo_cuenta">
                <option value="Ahorro">Ahorro</option>
                <option value="Monetaria">Monetaria</option>
            </select>
            @error('tipo_cuenta') <span class="error">{{ $message }}</span> @enderror

            <label>Saldo actual</label>
            <input type="number" step="0.01" wire:model="saldo">
            @error('saldo') <span class="error">{{ $message }}</span> @enderror

            <br><br>
            <button type="submit">{{ $cuenta_id ? 'Actualizar' : 'Guardar' }}</button>
            @if ($cuenta_id)
                <button type="button" wire:click="limpiar">Cancelar</button>
            @endif
        </form>
    </div>

    <div class="caja">
        <table>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>No. de cuenta</th>
                <th>Tipo</th>
                <th>Saldo</th>
                <th>Acciones</th>
            </tr>
            @forelse ($cuentas as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->cliente->nombre_completo }}</td>
                    <td>{{ $c->numero_cuenta }}</td>
                    <td>{{ $c->tipo_cuenta }}</td>
                    <td>Q {{ number_format($c->saldo, 2) }}</td>
                    <td>
                        <button wire:click="editar({{ $c->id }})">Editar</button>
                        <button wire:click="eliminar({{ $c->id }})"
                                wire:confirm="¿Eliminar esta cuenta?">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay cuentas registradas</td></tr>
            @endforelse
        </table>
    </div>
</div>
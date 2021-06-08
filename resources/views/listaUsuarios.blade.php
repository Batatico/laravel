<h1>Lista Usuarios</h1>

<table border="1">
    <tbody>
        <tr>
            <td>Nombre</td>
            <td>Rut</td>
            <td>Email</td>
            <td>Rol</td>
        </tr>
        @foreach($users as $user)
        <tr>
        <td>{{$user['name']}}</td>
        <td>{{$user['rut']}}</td>
        <td>{{$user['email']}}</td>
        <td>{{$user['id']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<button onclick="window.history.back();">Volver atrás</button>
{{ include('layouts/header.php', {title:'Groups'})}}
    <h1>Groups</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
          {% for groupe in groupes %}
            <tr>
                <td><a href="{{base}}/groupe/show?id={{groupe.gid}}">{{ groupe.name }}</a></td>
                <td>{{ groupe.description }}</td>
            </tr>
          {% endfor %}
        </tbody>
    </table>
    <a href="{{base}}/groupe/create" class="btn">New Group</a>
{{ include('layouts/footer.php')}}

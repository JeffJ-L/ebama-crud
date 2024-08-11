{{ include('layouts/header.php', {title:'Show Group'})}}
    <div class="container">
        <h1>Group</h1>
        <p><strong>Name:</strong> {{ groupe.name }}</p>
        <p><strong>Description:</strong> {{ groupe.description }}</p>

        <h2>Professors</h2>
        {% if professors is not empty %}
            <ul>
                {% for professor in professors %}
                    <li>{{ professor.name }} ({{ professor.email }})</li>
                {% endfor %}
            </ul>
        {% else %}
            <p>No professors assigned to this group.</p>
        {% endif %}

        <h2>Number of Students</h2>
        <p>{{ student_count }} student(s) in this group</p>

        <a class="btn" href="{{base}}/groupe/edit?id={{ groupe.gid }}">Edit</a>
        <form action="{{base}}/groupe/delete" method="post">
            <input type="hidden" name="id" value="{{ groupe.gid }}">
            <button class="btn red">Delete</button>
        </form>    
    </div>
{{ include('layouts/footer.php')}}

{{ include('layouts/header.php', {title:'Create Group'})}}
    <div class="container">
        <form method="post">
            <h2>New Group</h2>
            <label>Name
                <input type="text" name="name" value="{{ groupe.name }}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.name }}</span>
            {% endif %}
            <label>Description
                <textarea name="description">{{ groupe.description }}</textarea>
            </label>
            {% if errors.description is defined %}
                <span class="error">{{ errors.description }}</span>
            {% endif %}
            <input type="submit" class="btn" value="Save">
        </form>
    </div>
{{ include('layouts/footer.php')}}

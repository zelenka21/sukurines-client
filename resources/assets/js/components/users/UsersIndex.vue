<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createUser'}" class="btn btn-primary">Add new user</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">User list</div>
            <div class="panel-body">
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>email</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user, index in users">
                        <td>{{ user.id  }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <router-link :to="{name: 'editUser', params: {id: user.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <router-link :to="{name: 'viewUser', params: {id: user.id}}" class="btn btn-xs btn-default">
                                View
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(user.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                users: []
            }
        },
        mounted() {
            var app = this;

            axios.get(process.env.MIX_API_URL+'/api/users')
                .then(function (resp) {
                    app.users = resp.data.data;
                    console.log(app.users);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load users");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete(process.env.MIX_API_URL+'/api/users/' + id)
                        .then(function (resp) {
                            app.users.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete user");
                        });
                }
            }
        }
    }
</script>

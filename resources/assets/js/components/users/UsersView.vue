<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">User information</div>
            <div class="panel-body">
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>email</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ users.id  }}</td>
                        <td>{{ users.name }}</td>
                        <td>{{ users.email }}</td>

                         
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
         <div class="panel-heading">User reservations</div>
            <div class="panel-body">
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Apartment</th>
                        <th>Guests</th>
                        <th>arrival</th>
                        <th>departure</th>
                         <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                     <tr v-for="res, index in reservations">
                        <td>{{ res.apartment_id  }}</td>
                        <td>{{ res.guestCount }}</td>
                        <td>{{ res.arrival }}</td>
                        <td>{{ res.departure }}</td>
                               <td>
                            <router-link :to="{name: 'editReservation', params: {id: users.id, rid: res.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(users.id, res.id, index)">
                                Delete
                            </a>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
</template>

<script>
    export default {
         data: function () {
            return {
                users: [],
                reservations: []
            }
        },
        mounted() {
            let app = this;

            let id = app.$route.params.id;

            axios.get(process.env.MIX_API_URL+'/api/users/'+ id)
                .then(function (resp) {
                    app.users = resp.data.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load users");
                });


            axios.get(process.env.MIX_API_URL+'api/users/'+ id + '/reservations/')
                .then(function (resp) {
                    app.reservations = resp.data.data;
                    console.log(app.reservations);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load reservations");
                });

        },
        methods: {
            deleteEntry(userid,id,index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete(process.env.MIX_API_URL+'api/users/'+ userid + '/reservations/' + id)
                        .then(function (resp) {
                            app.reservations.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete user");
                        });
                }
            }
        }

        
        
    }
</script>

<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createApartment'}" class="btn btn-outline-secondary">Can not write reviews as admin</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Reviews list</div>
            <div class="panel-body">
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="apartment, index in apartments">
                        <td>{{ apartment.id  }}</td>
                        <td>{{ apartment.title }}</td>
                        <td>{{ apartment.description }}</td>
                        <td>{{ apartment.location }}</td>
                        <td>
                            <router-link :to="{name: 'editApartment', params: {id: apartment.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(apartment.id, index)">
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
                apartments: []
            }
        },
        mounted() {
            var app = this;

            axios.get(process.env.MIX_API_URL+'/api/apartments/')
                .then(function (resp) {
                    app.apartments = resp.data.data;
                    console.log(app.apartments);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load apartments");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete(process.env.MIX_API_URL+'/api/apartments/' + id)
                        .then(function (resp) {
                            app.apartments.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete apartment");
                        });
                }
            }
        }
    }
</script>
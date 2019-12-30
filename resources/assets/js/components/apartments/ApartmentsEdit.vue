
<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Edit apartment</div>
            <div class="panel-body">
                <form v-on:submit.prevent="saveForm()">
                    <div class="row">
                             <div class="col-xs-12 form-group">
                            <label class="control-label">Apartment title</label>
                            <input type="text" v-model="apartment.title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Apartment description</label>
                            <input type="text" v-model="apartment.description" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Apartment location</label>
                            <input type="text" v-model="apartment.location" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Apartment image</label>
                            <input type="text" v-model="apartment.image" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.apartmentId = id;
            axios.get(process.env.MIX_API_URL+'api/apartments/' + id)
                .then(function (resp) {
                    app.apartment = resp.data;
                })
                .catch(function () {
                    alert("Could not load your apartment")
                });
        },
        data: function () {
            return {
                apartmentId: null,
                apartment: {
                    title: '',
                    description: '',
                    location: '',
                    image: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newApartment = app.apartment;
                axios.patch(process.env.MIX_API_URL+'api/apartments/' + app.apartmentId, newApartment)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your apartment");
                    });
            }
        }
    }
</script>

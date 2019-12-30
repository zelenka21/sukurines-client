
<template>
    <div>

        <div class="panel panel-default">
            <div class="panel-heading">Edit reservation</div>
            <div class="panel-body">
                <form v-on:submit.prevent="saveForm()">
                  <div class="row">

                        <div class="col-xs-12 form-group">
                            <label class="control-label">Apartment</label>
                            <input type="text" v-model="reservation.apartment_id" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Guests</label>
                            <input type="text" v-model="reservation.guestCount" class="form-control">
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Arrival</label>
                            <input type="text" v-model="reservation.arrival" class="form-control">
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Departure</label>
                            <input type="text" v-model="reservation.departure" class="form-control">
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
            let rid = app.$route.params.rid;
            app.resID = rid;
            app.usrID = id;

             axios.get(process.env.MIX_API_URL+'/api/users/'+ id + '/reservations/' +rid)
                .then(function (resp) {
                    app.reservations = resp.data.data;
                    console.log(app.reservations);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load reservations");
                });




        },
        data: function () {
            return {
                userId: null,
                resID: null,
              reservation: {
                    apartment_id: '',
                    guestCount: '',
                    arrival: '',
                    departure: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newR = app.reservation;
                axios.patch(process.env.MIX_API_URL+'api/users/'+ app.usrID + '/reservations/' + app.resID, newR)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("You can't edit this reservation");
                    });
            }
        }
    }
</script>

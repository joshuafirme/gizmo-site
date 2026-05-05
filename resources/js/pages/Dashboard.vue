<template>

    <div style="margin-top: 200px;">

        <h3>Dashboard</h3>

        <div class="row mt-4">

            <div class="col-md-4">

                <div class="card text-center p-3">
                    <h5>Sticker Applications</h5>
                    <p>Manage vehicle stickers</p>
                    <router-link class="btn btn-primary" to="/sticker/my-applications">
                        View
                    </router-link>
                </div>

            </div>

            <div class="col-md-4">

                <div class="card text-center p-3">
                    <h5>Monthly Dues</h5>
                    <p>View your HOA payments</p>
                    <router-link class="btn btn-primary" to="/monthly-dues">
                        Open
                    </router-link>
                </div>

            </div>

        </div>

    </div>

</template>
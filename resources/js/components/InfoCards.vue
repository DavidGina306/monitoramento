<template>
    <div class="card-box p-1 bg-info mt-1 rounded">
        <div class="inner">
            <h4> {{item.cliente}} </h4>
            <p> {{item.numped}}</p>
        </div>
        <div class="icon">
            <i class="fas fa-people-carry"/>
        </div>
        <div v-if="card.time" class="card-box-footer  d-inline p-1 rounded">
            <i class="far fa-clock"/> {{ card.time | time}} min
        </div>
    </div>
</template>
<script>
    const moment = require('moment');
    export default {
        props: {
            item: {
                type: Object,
                required: false
            }
        },
        data() {
            return {
                card: this.item
            }
        },
        mounted() {
            this.card.time = moment();
        },
        filters: {
            time(startTime) {
                let duration = moment.duration(moment(new Date()).diff(startTime));
                return parseFloat(duration.asMinutes()).toFixed(0);
            }
        }
    }
</script>
<style scoped>
    .card-box {
        position: relative;
        color: #fff;
    }

    .card-box:hover {
        text-decoration: none;
        color: #f1f1f1;
    }

    .card-box:hover .icon i {
        font-size: 70px;
        transition: 600ms;
        -webkit-transition: 600ms;
    }


    .card-box h3 {
        font-size: 27px;
        font-weight: bold;
        margin: 0 0 8px 0;
        white-space: nowrap;
        padding: 0;
        text-align: left;
    }

    .card-box p {
        font-size: 15px;
    }

    .card-box .icon {
        position: absolute;
        top: auto;
        bottom: 5px;
        right: 7px;
        font-size: 55px;
        color: rgba(0, 0, 0, 0.17);
    }

    .card-box .card-box-footer {

        text-align: center;
        padding: 3px 0;
        color: rgba(255, 255, 255, 0.8);
        background: rgba(0, 0, 0, 0.1);
        width: 100%;
        text-decoration: none;
    }

</style>

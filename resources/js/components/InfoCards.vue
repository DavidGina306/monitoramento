<template>
    <div class="card-box p-1 bg-info mt-1 rounded">
        <div class="inner">
            <h5> {{item.cliente | nomeCliente}} </h5>
            <p> <b>{{item.numped}}</b> <span style="font-size: 16px !important;" :class="item.cliente | classItem">
                <i class="far fa-clock"/> {{ item.cliente | time}} min
            </span></p>
        </div>
        <div class="icon">
            <i class="fas fa-people-carry"/>
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
        filters: {
            classItem(nome){
                let time = nome.split(':');
                time = time.pop().trim();
                return parseInt(time) && +time >= 10 ? 'badge badge-danger' : 'badge badge-default';
            },
            nomeCliente(nome){
                let novoNome = nome.split('-');
                novoNome.pop();
                return novoNome.join('-');
            },
             time(nome){
                let time = nome.split(':');
                return time.pop().trim();
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

    .badge-default{
        color: rgba(255, 255, 255, 0.8) !important;
        background: rgba(0, 0, 0, 0.1);
    }
    .card-box .card-box-footer {
        text-align: center;
        padding: 3px 0;
        width: 100%;
        text-decoration: none;
    }

</style>

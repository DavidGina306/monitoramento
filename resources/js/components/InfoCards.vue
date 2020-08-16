<template>
    <div class="col-lg-6 col-sm-12">
        <div class="card-box bg-citze">
            <div class="inner">
                <h3> {{item.numped}} </h3>
                <p> {{item.cliente}}</p>
            </div>
            <div class="icon">
                <i class="fas fa-people-carry"></i>
            </div>
            <a href="#" class="card-box-footer"><span class="float-center"><i class="far fa-clock"></i> 00:00:00</span></a>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        item: {
            type: Object,
            required: false
        }
    }
}
</script>
<style scoped>
.card-box {
    position: relative;
    color: #fff;
    padding: 10px 10px 15px;
    margin: 20px 0px;
    border-radius: 25px;
}
.card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
}
.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}
.card-box .inner {
    padding: 5px 10px 0 10px;
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
    z-index: 0;
    font-size: 55px;
    color: rgba(0, 0, 0, 0.17);
}
.card-box .card-box-footer {
    position: absolute;
    border-radius: 25px;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}
.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
}
.bg-blue {
    background-color: #00c0ef !important;
}
.bg-green {
    background-color: #00a65a !important;
}
.bg-orange {
    background-color: #f39c12 !important;
}
.bg-red {
    background-color: #d9534f !important;
}
.bg-citze {
   background-color: #9bb1be !important;
}
</style>

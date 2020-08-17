<template>
    <b-card class="p-1 mt-1 mb-1">
        <h3> {{item.numped}} </h3>
        <p> {{item.cliente}}</p>
        <div class="text-center">
            <b-button size="sm" class="font-weight-bold"><i class="far fa-clock"/> 00:00:00</b-button>
        </div>
    </b-card>
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

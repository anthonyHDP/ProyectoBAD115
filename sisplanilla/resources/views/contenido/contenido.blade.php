        @extends('principal')
        @section('contenido')
        <template v-if="menu==0">
            <h1>ESCRITORIO</h1>
            <!-- <example-component></example-component> -->
        </template>

        <template v-if="menu==1">
            <usuario></usuario>
        </template>

        <template v-if="menu==2">
            <rol></rol>
        </template>

        <template v-if="menu==3">
            <privilegio></privilegio>
        </template>

        <template v-if="menu==4">
            <h1>Contenido del menú 4</h1>
        </template>

        <template v-if="menu==5">
            <h1>Contenido del menú 5</h1>
        </template>
        

    @endsection
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
            <menu_valido></menu_valido>
        </template>

        <template v-if="menu==5">
            <item_menu></item_menu>
        </template>
        
        <template v-if="menu==6">
            <empresa></empresa>
        </template>

    @endsection
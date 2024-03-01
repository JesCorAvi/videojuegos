<x-app-layout>

    @vite('resources/css/app.css')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre del Videojuego
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Año
                    </th>
                    <th scope="col" class="px-6 py-3">
                        desarrolladora
                    </th>
                    <th scope="col" class="px-6 py-3">
                        distribuidora
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videojuegos as $videojuego)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$videojuego->titulo}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$videojuego->anyo}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$videojuego->desarrolladora->nombre}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$videojuego->desarrolladora->distribuidora->nombre}}
                    </th>
                    <td class="px-6 py-4">
                        <a href="{{route("videojuegos.edit", $videojuego)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a><br>
                        <form action="{{route("videojuegos.destroy", $videojuego)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Borrar</button>
                        </form>

                    </td>
                </tr>
                @endforeach
                <a href="{{route("videojuegos.create")}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Crear</a>

            </tbody>
        </table>
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</x-app-layout>

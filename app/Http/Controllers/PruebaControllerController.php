<?php

namespace App\Http\Controllers;

use App\Models\Prueba; // Asegúrate de importar correctamente el modelo 'Prueba'
use Illuminate\Http\Request;


/**
 * @OA\Info(
 *     title="API de Pruebas",
 *     description="API para realizar pruebas de ingeniería de sistemas",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="support@example.com"
 *     )
 * )
 */
class PruebaControllerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/prueba",
     *     summary="Listar todos los recursos",
     *     description="Obtiene una lista de todas las pruebas",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pruebas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="name", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron recursos"
     *     )
     * )
     */
    public function index()
    {
        // Obtener todos los recursos de la base de datos
        $pruebas = Prueba::all();

        // Retornar los datos en formato JSON
        return response()->json($pruebas);
    }

    /**
     * @OA\Get(
     *     path="/api/prueba/create",
     *     summary="Mostrar formulario para crear un recurso",
     *     description="Devuelve un formulario para crear una nueva prueba",
     *     @OA\Response(
     *         response=200,
     *         description="Formulario para crear recurso",
     *         @OA\JsonContent(type="string", example="Formulario HTML")
     *     )
     * )
     */
    public function create()
    {
        // Lógica para mostrar el formulario para crear un recurso
    }

    /**
     * @OA\Post(
     *     path="/api/prueba",
     *     summary="Crear una nueva prueba",
     *     description="Crea un nuevo recurso de prueba en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name"},
     *             @OA\Property(property="name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Recurso creado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en los datos enviados"
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Validar y almacenar el recurso
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $prueba = Prueba::create($validated);

        return response()->json($prueba, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/prueba/{id}",
     *     summary="Mostrar un recurso específico",
     *     description="Devuelve un recurso de prueba específico por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recurso encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        // Buscar el recurso por su ID
        $prueba = Prueba::find($id);

        if (!$prueba) {
            return response()->json(['message' => 'Recurso no encontrado'], 404);
        }

        return response()->json($prueba);
    }

    /**
     * @OA\Get(
     *     path="/api/prueba/{id}/edit",
     *     summary="Mostrar formulario para editar un recurso",
     *     description="Devuelve un formulario para editar una prueba existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Formulario para editar recurso",
     *         @OA\JsonContent(type="string", example="Formulario HTML")
     *     )
     * )
     */
    public function edit($id)
    {
        // Lógica para mostrar el formulario de edición
        $prueba = Prueba::find($id);

        if (!$prueba) {
            return response()->json(['message' => 'Recurso no encontrado'], 404);
        }

        // Aquí deberías devolver la vista del formulario de edición (si es el caso)
        return response()->json($prueba);
    }

    /**
     * @OA\Put(
     *     path="/api/prueba/{id}",
     *     summary="Actualizar un recurso",
     *     description="Actualiza un recurso de prueba existente por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name"},
     *             @OA\Property(property="name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recurso actualizado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos incorrectos"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        // Validar y actualizar el recurso
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $prueba = Prueba::find($id);

        if (!$prueba) {
            return response()->json(['message' => 'Recurso no encontrado'], 404);
        }

        $prueba->update($validated);

        return response()->json($prueba);
    }

    /**
     * @OA\Delete(
     *     path="/api/prueba/{id}",
     *     summary="Eliminar un recurso",
     *     description="Elimina un recurso de prueba por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Recurso eliminado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recurso no encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        // Buscar el recurso por su ID
        $prueba = Prueba::find($id);

        if (!$prueba) {
            return response()->json(['message' => 'Recurso no encontrado'], 404);
        }

        // Eliminar el recurso
        $prueba->delete();

        return response()->json(['message' => 'Recurso eliminado'], 204);
    }
}

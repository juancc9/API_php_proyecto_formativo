import { useState } from "react";
import  useFetchUsuarios  from "@/hooks/users/useFetchUsuarios";
import DefaultLayout from "@/layouts/default";
import { Button } from "@heroui/react";

const UsuariosList = () => {
  const { data, isLoading, error } = useFetchUsuarios(); // Asegúrate de extraer `data`
  const [usuarioSeleccionado, setUsuarioSeleccionado] = useState<string | null>(null);

  return (
    <DefaultLayout>
      <h2 className="text-lg font-bold mb-4">Usuarios Registrados</h2>
      <div className="overflow-x-auto">
        <table className="min-w-full bg-white border border-gray-300 shadow-md">
          <thead className="bg-gray-800 text-white">
            <tr>
              <th className="px-4 py-2">Identificación</th>
              <th className="px-4 py-2">Nombre</th>
              <th className="px-4 py-2">Apellido</th>
              <th className="px-4 py-2">Fecha de Nacimiento</th>
              <th className="px-4 py-2">Teléfono</th>
              <th className="px-4 py-2">Email</th>
              <th className="px-4 py-2">Área de Desarrollo</th>
              <th className="px-4 py-2">Rol</th>
            </tr>
          </thead>
          <tbody>
            {isLoading ? (
              <tr>
                <td colSpan={8} className="text-center py-4">Cargando usuarios...</td>
              </tr>
            ) : error ? (
              <tr>
                <td colSpan={8} className="text-center py-4 text-red-500">Error al cargar usuarios</td>
              </tr>
            ) : data && data.length > 0 ? (
              data.map((usuario) => (
                <tr key={usuario.identificacion} className="border-b">
                  <td className="px-4 py-2">{usuario.identificacion}</td>
                  <td className="px-4 py-2">{usuario.nombre}</td>
                  <td className="px-4 py-2">{usuario.apellido}</td>
                  <td className="px-4 py-2">{usuario.fecha_nacimiento}</td>
                  <td className="px-4 py-2">{usuario.telefono}</td>
                  <td className="px-4 py-2">{usuario.email}</td>
                  <td className="px-4 py-2">{usuario.area_desarrollo}</td>
                  <td className="px-4 py-2">{usuario.fk_rol}</td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan={8} className="text-center py-4">No hay usuarios disponibles</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </DefaultLayout>
  );
};

export default UsuariosList;

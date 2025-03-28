import { useMutation, useQueryClient } from "@tanstack/react-query";
import axios from "axios";

const deleteTipoSensor = async (id: string) => {
  const token = localStorage.getItem("token"); // Obtiene el token almacenado

  axios.defaults.withCredentials = true; // Habilita el envío de cookies si es necesario

  await axios.delete(`http://127.0.0.1:8000/api/tiposensor/${id}/`, {
    headers: {
      Authorization: `Bearer ${token}`, // Enviar el token en el encabezado
    },
  });
};

export const useDeleteTipoSensor = () => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: deleteTipoSensor,
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ["tipoSensores"] }); // Refresca la lista de tipos de sensores
    },
  });
};

// Importado en el componente donde se elimina un tipo de sensor

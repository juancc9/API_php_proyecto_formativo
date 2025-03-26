import { useState, useEffect } from "react";

const useFetchUsuarios = () => {
  const [data, setData] = useState<any[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<Error | null>(null);

  useEffect(() => {
    const fetchUsuarios = async () => {
      try {
        const token = localStorage.getItem("token");
        const response = await fetch("http://localhost/agrosoft_mvc/usuario/", {
          headers: { Authorization: `Bearer ${token}` },
        });

        if (!response.ok) throw new Error("Error al obtener usuarios");

        const jsonResponse = await response.json();
        console.log("📢 Respuesta de la API:", jsonResponse);

        if (Array.isArray(jsonResponse.data)) {
          setData(jsonResponse.data); // Aquí accedemos a `data`
        } else {
          setData([]);
        }
      } catch (err) {
        setError(err as Error);
      } finally {
        setIsLoading(false);
      }
    };

    fetchUsuarios();
  }, []);

  return { data, isLoading, error };
};

export default useFetchUsuarios;

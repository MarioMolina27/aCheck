export const fetchModulesByCicle = async (cicleId) => 
{
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/moduls/modulesByCicle/${cicleId}`;

    try 
    {
        const response = await fetch(url);
        if (!response.ok) throw new Error('Error en la petición');
        let data = await response.json();

        return data;
    }
    catch (error) {
        throw error;
    }
}

export const fetchModulesByAlumne = async (alumneId) => {
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/moduls/modulsMatriculats/${alumneId}`;

    try {
        const response = await axios.get(url);
        if (response.status !== 200) throw new Error('Error en la petición');
        return response.data;

    } catch (error) {
        console.log('error');
        throw error;
    }
}
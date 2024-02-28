export const fecthAlumnes = async () =>{
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/usuaris/getalumnes`;
    try {
        const response = await axios.get(url);
        
        if (response.status !== 200) 
        {
            throw new Error("Error");
        }
        console.log(response.data);
        return response.data;
    }
    catch (error) {
        console.error(error);
    }
}

export const fecthAlumnesByModul = async (modul) =>{
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/usuaris/getAllAlumnesByModul/${modul}`;
    try {
        const response = await axios.get(url);
        
        if (response.status !== 200) 
        {
            throw new Error("Error");
        }
        console.log(response.data);
        return response.data;
    }
    catch (error) {
        console.error(error);
    }
}
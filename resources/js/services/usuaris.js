export const fecthAlumnes = async (accessToken) =>{
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/auth/usuaris/getalumnes`;
    try {
        const response = await axios.get(url, {
            headers: {
                Authorization: `Bearer ${accessToken}`
            }
        });
        
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

export const fecthAlumnesByModul = async (modul,accessToken) =>{
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/auth/usuaris/getAllAlumnesByModul/${modul}`;
    try {
        const response = await axios.get(url, {
            headers: {
                Authorization: `Bearer ${accessToken}`
            }
        });
        
        if (response.status !== 200) 
        {
            throw new Error("Error");
        }
        return response.data;
    }
    catch (error) {
        console.error(error);
    }
}
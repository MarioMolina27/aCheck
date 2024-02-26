export const fetchResultatsByModuls = async (modulsId,userId) => {
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/resultatsAprenentage/resultatsByModul/${modulsId}/${userId}`
    try {
        const response = await axios.get(url);
        if (response.status !== 200) {
            throw new Error("Error");
        }
        return response.data;
    } catch (error) {
        console.error(error);
    }
}
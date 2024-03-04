export const fetchResultatsByModuls = async (modulsId,userId,accessToken) => {
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/auth/resultatsAprenentage/resultatsByModul/${modulsId}/${userId}`
    try {
        const response = await axios.get(url, {
            headers: {
                Authorization: `Bearer ${accessToken}`
            }
        });
        if (response.status !== 200) {
            throw new Error("Error");
        }
        return response.data;
    } catch (error) {
        console.error(error);
    }
}
export const updateNotaCriters = (idCriteri,idUsuari,nota,accessToken) => {
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/auth/usuaris/updateCriteriNota/${idUsuari}/${idCriteri}`
    const config = {
        headers: {
            Authorization: `Bearer ${accessToken}`
        }
    };

    return axios.put(url, { nota: nota }, config);
}
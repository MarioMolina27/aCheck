export const updateNotaCriters = (idCriteri,idUsuari,nota) => {
    const url = `http://localhost:8080/autoavaluacio_MarioMolina/public/api/usuaris/updateCriteriNota/${idUsuari}/${idCriteri}`
    return axios.put(url,{ nota: nota })
}
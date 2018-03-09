import axios from 'axios'
// la classe Api regroupe les appels ajax envoyés à l'api
export default class Api {
  // on créé une variable qui contient la base de l'url du serveur
  constructor (){
    this.baseUrl = 'http://localhost'
  }
  // cette méthode permet d'obtenir un poll et ses options à partir d'un id
  getPollById (pollId){
    return axios.get(`${this.baseUrl}/polls/${pollId}`)
  }
  // cette méthode permet de créer un poll et ses options
  setPoll (poll){
    return axios.post(`${this.baseUrl}/polls`, poll)
  }
  // cette méthode permet d'incrémenter le compteur de vote pour une option à partir de son id
  vote (optionId){
    return axios.patch(`${this.baseUrl}/options/${optionId}/vote`)
  }
}
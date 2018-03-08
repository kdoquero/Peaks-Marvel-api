import axios from 'axios'

export default class Api {
  constructor (){
    this.baseUrl = 'http://localhost'
  }

  getPollById (pollId){
    return axios.get(`${this.baseUrl}/polls/${pollId}`)
  }

  setPoll (poll){
    return axios.post(`${this.baseUrl}/polls`, poll)
  }

  vote (optionId){
    return axios.patch(`${this.baseUrl}/options/${optionId}/vote`)
  }
}
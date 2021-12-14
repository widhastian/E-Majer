package com.kelompok.e_majer.model.login;

import com.google.gson.annotations.SerializedName;

public class LoginData {

    @SerializedName("user_id")
    private String userId;

    @SerializedName("nama")
    private String name;

    @SerializedName("username")
    private String username;

    @SerializedName("kelas")
    private String kelas;

    @SerializedName("email")
    private String email;

    @SerializedName("password")
    private String password;

    public void setUserId(String userId){
        this.userId = userId;
    }

    public String getUserId(){
        return userId;
    }

    public void setName(String name){
        this.name = name;
    }

    public String getName(){
        return name;
    }

    public void setUsername(String username){
        this.username = username;
    }

    public String getUsername(){
        return username;
    }

    public void setKelas(String nama_kelas){this.kelas = kelas; }
    public String getKelas(){
        return kelas;
    }

    public void setEmail(String email){this.email = email; }
    public String getEmail() { return email; }

    public void setPassword(String password){this.password = password; }
    public String getPassword() { return password; }
}
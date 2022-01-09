package com.kelompok.emajer.Model.PembayaranKas;

import java.io.Serializable;

public class PilihMinggu implements Serializable {
    private int idMinggu;
    private Integer nominal;
    private String keterangan;

    public PilihMinggu(int idMinggu, Integer nominal, String keterangan) {
        this.idMinggu = idMinggu;
        this.nominal = nominal;
        this.keterangan = keterangan;
    }

    public int getIdMinggu() {
        return idMinggu;
    }

    public void setIdMinggu(int idMinggu) {
        this.idMinggu = idMinggu;
    }

    public Integer getNominal() {
        return nominal;
    }

    public void setNominal(Integer nominal) {
        this.nominal = nominal;
    }

    public String getKeterangan() {
        return keterangan;
    }

    public void setKeterangan(String keterangan) {
        this.keterangan = keterangan;
    }
}
